package user

import (
	"github.com/gin-gonic/gin"
	"../../model"
	. "../../handler"
)

func Get(c *gin.Context) {
	username := c.Param("username")
	user, err := model.GetUser(username)
	if err != nil {
		SendResponse(c, err, nil)
		return
	}

	user.Password = ""

	SendResponse(c, nil, user)
}