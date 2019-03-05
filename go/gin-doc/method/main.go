package main

import "net/http"
import "github.com/gin-gonic/gin"

func getting(c *gin.Context) {
	c.String(http.StatusOK, "get")
}

func posting(c *gin.Context) {
	c.String(http.StatusOK, "post")
}

func putting(c *gin.Context) {
	c.String(http.StatusOK, "put")
}

func deleting(c *gin.Context) {
	c.String(http.StatusOK, "delete")
}

func patching(c *gin.Context) {
	c.String(http.StatusOK, "patch")
}

func head(c *gin.Context) {
	c.String(http.StatusOK, "head")
}

func options(c *gin.Context) {
	c.String(http.StatusOK, "options")
}

func main() {
	router := gin.Default()
	router.GET("/", getting)
	router.POST("/", posting)
	router.PUT("/", putting)
	router.DELETE("/", deleting)
	router.PATCH("/", patching)
	router.HEAD("/", head)
	router.OPTIONS("/", options)
	router.Run()
}