package controllers

import (
	"github.com/labstack/echo/v4"
	"golang.org/x/exp/slices"
	"gorm.io/driver/sqlite"
	"gorm.io/gorm"
	"net/http"
	"strconv"
	"zad04-go/models"
	"zad04-go/proxy"
)

type WeatherController struct {
	DB *gorm.DB
}

type weather struct {
	City        string `json:"city"`
	Temperature int    `json:"temperature"`
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

	err = db.Table("weather").AutoMigrate(&models.Weather{})
	if err != nil {
		return nil
	}

	for i := 0; i < len(weathers); i++ {
		db.Create(&models.Weather{City: weathers[i].City, Temperature: weathers[i].Temperature})
	}

	return &WeatherController{
		DB: db,
	}
}

func (ctrl *WeatherController) GetWeathers(c echo.Context) error {
	return c.JSON(http.StatusOK, weathers)
}

func (ctrl *WeatherController) GetCityWeather(c echo.Context) error {
	city := c.Param("city")
	idx := slices.IndexFunc(weathers, func(c weather) bool { return c.City == city })
	return c.String(http.StatusOK, "Temperature in "+city+" is "+strconv.Itoa(weathers[idx].Temperature))
}

func (ctrl *WeatherController) GetDBWeather(c echo.Context) error {
	city := c.Param("city")
	var weather models.Weather

	if err := ctrl.DB.Where("city = ?", city).First(&weather).Error; err != nil {
		return c.String(404, "No city with this name in database")
	}

	return c.String(http.StatusOK, "(DB) Temperature in "+weather.City+" is "+strconv.Itoa(weather.Temperature))
}

func (ctrl *WeatherController) GetApiWeather(c echo.Context) error {
	wProxy := proxy.NewWeatherProxy()

	return c.JSON(http.StatusOK, wProxy.GetCityWeather(c))
}
