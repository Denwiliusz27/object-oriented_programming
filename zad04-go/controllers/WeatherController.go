package controllers

import (
	"github.com/labstack/echo/v4"
	"golang.org/x/exp/slices"
	"net/http"
	"strconv"
)

type WeatherController struct{}

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

	return &WeatherController{}
}

func (ctrl *WeatherController) GetWeather(c echo.Context) error {
	return c.JSON(http.StatusOK, weathers)
}

func (ctrl *WeatherController) GetCityWeather(c echo.Context) error {
	city := c.Param("city")
	idx := slices.IndexFunc(weathers, func(c weather) bool { return c.City == city })
	return c.String(http.StatusOK, "Temperature in "+city+" is "+strconv.Itoa(weathers[idx].Temperature))
}
