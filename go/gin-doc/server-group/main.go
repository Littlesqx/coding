package main

import "net/http"
import "fmt"
import "time"
import "github.com/gin-gonic/gin"
import "golang.org/x/sync/errgroup"

var g errgroup.Group

func router01() http.Handler {
	r := gin.New()
	r.Use(gin.Recovery())
	r.GET("/", func(c *gin.Context) {
		c.JSON(
			http.StatusOK,
			gin.H{
				"code": http.StatusOK,
				"error": "Welcome server 01",
			},
		)
	})
	return r
}

func router02() http.Handler {
	r := gin.New()
	r.Use(gin.Recovery())
	r.GET("/", func(c *gin.Context) {
		c.JSON(
			http.StatusOK,
			gin.H{
				"code": http.StatusOK,
				"error": "Welcome server 02",
			},
		)
	})
	return r
}

func main() {
	server01 := &http.Server{
		Addr: ":8080",
		Handler: router01(),
		ReadTimeout: 5 * time.Second,
		WriteTimeout: 10 * time.Second,
	}

	server02 := &http.Server{
		Addr: ":8081",
		Handler: router02(),
		ReadTimeout: 5 * time.Second,
		WriteTimeout: 10 * time.Second,
	}

	g.Go(func() error {
		return server01.ListenAndServe()
	})
	
	g.Go(func() error {
		return server02.ListenAndServe()
	})

	if err := g.Wait(); err != nil {
		fmt.Println(err)
	}
}