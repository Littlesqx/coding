package user

import (
	. "../../handler"
	"../../model"
	"../../util"
	"github.com/gin-gonic/gin"
	"github.com/lexkong/log"
	"github.com/lexkong/log/lager"
)

func Get(c *gin.Context) {
	log.Info("User Get function called.", lager.Data{"X-Request-Id": util.GetReqID(c)})

	username := c.Param("username")
	user, err := model.GetUser(username)
	if err != nil {
		SendResponse(c, err, nil)
		return
	}

	user.Password = ""

	SendResponse(c, nil, user)
}
