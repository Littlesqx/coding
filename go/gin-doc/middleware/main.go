package main

import "fmt"
import "net/http"
import "github.com/gin-gonic/gin"

func MyMiddleware(c *gin.Context) {
	fmt.Println("In my middleware")
	c.Next()
}

func main() {
	r := gin.New() // 创建一个默认没有任何中间件的路由

	r.Use(gin.Logger())
	r.Use(gin.Recovery())
	r.Use(MyMiddleware)

	var i int = 0
	r.Use(func() gin.HandlerFunc {
		i = i+1
		return func(c *gin.Context) {
			fmt.Println("In my second middleware", i)
			c.Next()
		}
	}())

	r.GET("/", func(c *gin.Context) {
		c.String(http.StatusOK, "test")
	})

	r.Run()
}