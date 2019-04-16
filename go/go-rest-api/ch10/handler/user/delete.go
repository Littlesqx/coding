package user

import (
	. "../../handler"
	"../../model"
	"../../pkg/errno"
	"../../util"
	"github.com/gin-gonic/gin"
	"github.com/lexkong/log"
	"github.com/lexkong/log/lager"
	"strconv"
)

func Delete(c *gin.Context) {
	log.Info("User Delete function called.", lager.Data{"X-Request-Id": util.GetReqID(c)})

	userId, _ := strconv.Atoi(c.Param("id"))
	if err := model.DeleteUser(uint64(userId)); err != nil {
		SendResponse(c, errno.ErrDatabase, nil)
		return
	}

	SendResponse(c, nil, nil)
}
