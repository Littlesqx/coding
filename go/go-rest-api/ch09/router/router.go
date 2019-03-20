package router

import (
	"net/http"
	"github.com/gin-gonic/gin"
	"../handler/sd"
	"../handler/user"
	"./middleware"
)

func Load(g *gin.Engine, mw ...gin.HandlerFunc) *gin.Engine {
	g.Use(gin.Recovery())
	g.Use(middleware.NoCache)
	g.Use(middleware.Options)
	g.Use(middleware.Secure)
	g.Use(mw...)
	// 404 Handler
	g.NoRoute(func(c *gin.Context) {
		c.String(http.StatusNotFound, "The incorrect API route.")
	})
	svcd := g.Group("/sd")
	{
		svcd.GET("/health", sd.HealthCheck)
		svcd.GET("/disk", sd.DiskCheck)
		svcd.GET("/cpu", sd.CPUCheck)
		svcd.GET("/ram", sd.RAMCheck)
	}

	g.POST("/v1/login", user.Login)

	v1 := g.Group("/v1")
	v1.Use(middleware.AuthMiddleware())
	{
		v1.POST("/users", user.Create)         // 创建用户
		v1.DELETE("/users/:id", user.Delete)   // 删除用户 
		v1.PUT("/users/:id", user.Update)      // 更新用户
		v1.GET("/users", user.List)            // 用户列表
		v1.GET("/users/:username", user.Get)   // 获取指定用户的详细信息
	}

	return g
}