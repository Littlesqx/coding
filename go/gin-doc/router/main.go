package main

import "net/http"
import "github.com/gin-gonic/gin"

func main() {
	r := gin.Default()
	v1 := r.Group("/v1") 
	{
		v1.GET("/version", func(c *gin.Context) {
			c.String(http.StatusOK, "v1")
		})
	}
	v2 := r.Group("/v2") 
	{
		v2.GET("/version", func(c *gin.Context) {
			c.String(http.StatusOK, "v2")
		})
	}
	r.Run()
}