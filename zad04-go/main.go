package main

import (
	"github.com/labstack/echo/v4"
	"net/http"
	"zad04-go/controllers"
)

func main() {
	e := echo.New()
	weatherCtr := controllers.NewWeatherController()

	e.GET("/", func(c echo.Context) error {
		return c.String(http.StatusOK, "Hello world")
	})
	e.GET("/weather", weatherCtr.GetWeathers)
	e.GET("/weather/:city", weatherCtr.GetCityWeather)
	e.GET("/weather/db/:city", weatherCtr.GetDBWeather)
	e.GET("/weather/api/:city", weatherCtr.GetApiWeather)

	e.Logger.Fatal(e.Start(":1323"))
}
