package user

import (
	"fmt"
	"../../pkg/errno"
	. "../../handler"
	"github.com/gin-gonic/gin"
	"github.com/lexkong/log"
)

func Create(c *gin.Context) {
	var r CreateRequest

	var err error
	if err := c.Bind(&r); err != nil {
		SendResponse(c, errno.ErrBind, nil)
		return
	}

	admin2 := c.Param("username")
	log.Infof("URL username: %s", admin2)

	desc := c.Query("desc")
	log.Infof("URL key param desc: %s", desc)

	contentType := c.GetHeader("Content-Type")
	log.Infof("Header Content-Type: %s", contentType)


	log.Debugf("username is [%s], password is [%s]", r.Username, r.Password)

	if r.Username == "" {
		err = errno.New(errno.ErrUserNotFound, fmt.Errorf("username can not be empty.")).Add("This is the extra message.")
		log.Errorf(err, "Get an error.")
	}

	if errno.IsErrUserNotFound(err) {
		log.Debug("err type is ErrUserNotFound")
	}

	if r.Password == "" {
		err = fmt.Errorf("password is empty.")
	}

	if err != nil {
		SendResponse(c, err, nil)
		return
	}

	rsp := CreateResponse {
		Username: r.Username,
	}

	SendResponse(c, nil, rsp)
}
