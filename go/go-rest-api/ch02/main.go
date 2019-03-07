package main

import (
	"errors"
	"log"
	"time"
	"net/http"
	"./router"
	"./config"
	"github.com/gin-gonic/gin"
	"github.com/spf13/pflag"
	"github.com/spf13/viper"
)

var (
	cfg = pflag.StringP("config", "c", "", "apiserver config file path.")
)

func pingServer() error {
	for i := 0; i < viper.GetInt("max_ping_count"); i++ {
		rsp, err := http.Get(viper.GetString("url") + "/sd/health")
		if err == nil && rsp.StatusCode == 200 {
			return nil
		}
		log.Print("Waiting for the router, retry in 1 second.")
		time.Sleep(time.Second)
	}
	return errors.New("Cannot connect to the router.")
}

func main() {
	pflag.Parse()

	// init config
	if err := config.Init(*cfg); err != nil {
		panic(err)
	}

	// Set gin mode
	gin.SetMode(viper.GetString("runmode"))

	g := gin.New()
	middlewares := []gin.HandlerFunc{}
	router.Load(g, middlewares...)

	go func() {
		if err := pingServer(); err != nil {
			log.Fatal("The router has no response, or it might took too long to start up.", err)
		}
		log.Print("The router has been deployed successfully.")
	}()
	log.Printf("Start to listening the incoming requests on http address: %s", viper.GetString("addr"))
	log.Printf(http.ListenAndServe(viper.GetString("addr"), g).Error())
}