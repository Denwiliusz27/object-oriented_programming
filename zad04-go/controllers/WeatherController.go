package controllers

import (
	"fmt"
	"github.com/labstack/echo/v4"
	"golang.org/x/exp/slices"
	"gorm.io/driver/sqlite"
	"gorm.io/gorm"
	"net/http"
	"strconv"
)

type WeatherController struct{}

type weather struct {
	City        string `json:"city"`
	Temperature int    `json:"temperature"`
}

type Weather_ext struct {
	gorm.Model
	City        string
	Temperature int
}

var weathers = []weather{
	{
		City:        "Warsaw",
		Temperature: 18,
	},
	{
		City:        "Madrid",
		Temperature: 24,
	},
	{
		City:        "London",
		Temperature: 14,
	},
	{
		City:        "Paris",
		Temperature: 20,
	},
}

func NewWeatherController() *WeatherController {
	db, err := gorm.Open(sqlite.Open("test.db"), &gorm.Config{})
	if err != nil {
		panic("failed to connect database")
	}

	db.Table("weather").AutoMigrate(&Weather_ext{})

	var count int64

	if err := db.Table("weather").Count(&count).Error; err != nil {
		panic(err)
	}

	// Check if there are any records in the table
	if count == 0 {
		fmt.Println("The table is empty.")

		for i := 0; i < len(weathers); i++ {
			db.Create(&Weather_ext{City: weathers[i].City, Temperature: weathers[i].Temperature})
		}
	} else {
		fmt.Printf("There are %d records in the table.", count)
	}

	return &WeatherController{}
}

func (ctrl *WeatherController) GetWeathers(c echo.Context) error {
	return c.JSON(http.StatusOK, weathers)
}

func (ctrl *WeatherController) GetCityWeather(c echo.Context) error {
	city := c.Param("city")
	idx := slices.IndexFunc(weathers, func(c weather) bool { return c.City == city })
	return c.String(http.StatusOK, "Temperature in "+city+" is "+strconv.Itoa(weathers[idx].Temperature))
}

func (ctrl *WeatherController) GetDBWeathers(c echo.Context) error {
	db, err := gorm.Open(sqlite.Open("test.db"), &gorm.Config{})
	if err != nil {
		panic("failed to connect database")
	}

	city := c.Param("city")
	weather := &Weather_ext{}
	db.First(&weather, "city = ?", city) // find product with code D42

	return c.String(http.StatusOK, "(DB) Temperature in "+weather.City+" is "+strconv.Itoa(weather.Temperature))
}
