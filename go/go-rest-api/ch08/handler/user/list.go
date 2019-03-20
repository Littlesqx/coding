package user

import (
	. "../../handler"
	"../../service"
	"../../util"
	"../../pkg/errno"
	"github.com/gin-gonic/gin"
	"github.com/lexkong/log"
	"github.com/lexkong/log/lager"
)

func List(c *gin.Context) {
	log.Info("User List function called.", lager.Data{"X-Request-Id": util.GetReqID(c)})
	var r ListRequest
	if err := c.Bind(&r); err != nil {
		SendResponse(c, errno.ErrBind, nil)
		return
	}

	info, count, err := service.ListUser(r.Username, r.Offset, r.Limit)
	if err != nil {
		SendResponse(c, err, nil)
		return
	}
	SendResponse(c, nil, ListResponse{
		TotalCount: count,
		UserList: info,
	})
}