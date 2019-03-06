package main

import "fmt"
import "time"
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

	// 后台耗时使用协程
	r.GET("/long_async", func(c *gin.Context) {
		cCp := c.Copy() // **不应该 使用它里面的原始的 context ，只能去使用它的只读副本
		go func() {
			time.Sleep(5 * time.Second) // 模拟耗时
			fmt.Println("Done! in path ", cCp.Request.URL.Path)
		}()
	})

	r.GET("/long_sync", func(c *gin.Context) {
		time.Sleep(5 * time.Second) // 模拟耗时
		fmt.Println("Done! in path ", c.Request.URL.Path)
	})

	r.Run()
}