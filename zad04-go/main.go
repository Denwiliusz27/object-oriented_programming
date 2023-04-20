package main

import (
	"github.com/labstack/echo/v4"
	"net/http"
	"os"
	"zad04-go/controllers"
)

var apiKey = os.Getenv("api.openweathermap.org/data/2.5/forecast?id=524901&appid=a1a19934ccbd38186b9165232c12e09e")

func main() {
	e := echo.New()

	e.GET("/", func(c echo.Context) error {
		return c.String(http.StatusOK, "Hello world")
	})

	//e.GET("/weather/:city", func(c echo.Context) error {
	//	city := c.Param("city")
	//
	//	w, err := owm.NewCurrent("C", "PL", apiKey)
	//	if err != nil {
	//		log.Fatalln(err)
	//	}
	//
	//	w.CurrentByName("Phoenix")
	//	fmt.Println(w)
	//
	//	return c.String(http.StatusOK, city)
	//})

	weatherCtr := controllers.NewWeatherController()

	e.GET("/weather", weatherCtr.GetWeathers)
	e.GET("/weather/:city", weatherCtr.GetCityWeather)
	e.GET("/weather/db/:city", weatherCtr.GetDBWeathers)

	e.Logger.Fatal(e.Start(":1323"))
}
