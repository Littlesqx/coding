package main

import "fmt"
import "net/http"
import "github.com/gin-gonic/gin"

type Info struct {
	Message string `json:"message"`
	Nick string `json:"nick"`
}

func main() {
	r := gin.Default()
	r.GET("/param/:name", func(c *gin.Context) {
		name := c.Param("name")
		c.String(http.StatusOK, "Hello %s", name)
	})

	r.GET("/param/:name/*action", func(c *gin.Context) {
		name := c.Param("name")
		action := c.Param("action")
		message := name + " is " + action
		c.String(http.StatusOK, message)
	})

	r.GET("/params", func(c *gin.Context) {
		name := c.DefaultQuery("name", "Guest")
		c.String(http.StatusOK, "Hello %s", name)
	})

	r.POST("/params", func(c *gin.Context) {
		var info Info
		err := c.BindJSON(&info)

		message := c.PostForm("message")
		nick := c.DefaultPostForm("nick", "anonymous")

		fmt.Println(info, err)

		c.JSON(http.StatusOK, gin.H{
			"status": "posted",
			"message": message,
			"nick": nick,
			"message2": info.Message,
		})
	})

	r.Run()
}