package middleware

import (
	"bytes"
	"time"
	"regexp"
	"io/ioutil"
	"encoding/json"
	"github.com/lexkong/log"
	"github.com/gin-gonic/gin"
	"github.com/willf/pad"
	"../../handler"
	"../../pkg/errno"
)

type bodyLogWriter struct {
	gin.ResponseWriter
	body *bytes.Buffer
}

func Logging() gin.HandlerFunc {
	return func(c *gin.Context) {
		start := time.Now().UTC()
		path := c.Request.URL.Path

		reg := regexp.MustCompile("/v1/users")
		if !reg.MatchString(path) {
			return
		}
		var bodyBytes []byte
		if c.Request.Body != nil {
			bodyBytes, _ = ioutil.ReadAll(c.Request.Body)
		}
		// 该中间件需要截获 HTTP 的请求信息，然后打印请求信息，因为 HTTP 的请求 Body，在读取过后会被置空，所以这里读取完后会重新赋值
		c.Request.Body = ioutil.NopCloser(bytes.NewBuffer(bodyBytes))

		method := c.Request.Method
		ip := c.ClientIP()

		blw := &bodyLogWriter{
			body:			bytes.NewBufferString(""),
			ResponseWriter: c.Writer,
		}
		c.Writer = blw

		c.Next()

		end := time.Now().UTC()
		latency := end.Sub(start)

		code, message := -1, ""

		// 截获 HTTP 的 Response 更麻烦些，原理是重定向 HTTP 的 Response 到指定的 IO 流，详见源码文件
		var response handler.Response
		if err := json.Unmarshal(blw.body.Bytes(), &response); err != nil {
			log.Errorf(err, "response body can not unmarshal to model.Response struct, body: `%s`", blw.body.Bytes())
			code = errno.InternalServerError.Code
			message = err.Error()
		} else {
			code, message = response.Code, response.Message
		}
		
		log.Infof(
			"%-13s | %-12s | %s | %s | {code: %d, message: %s}", 
			latency, 
			ip, 
			pad.Right(method, 5, ""), 
			path, 
			code, 
			message,
		)
	}
}