// see 《快学 Go 语言》第 10 课 —— 错误与异常

package main

import "fmt"
import "os"

type SomeError struct {
	Reason string
}

func (s SomeError) Error() string {
	return s.Reason
}

var negErr = fmt.Errorf("non positive number")

func main() {
	var e error = SomeError {"something happened."}
	fmt.Println(e)

	var f, err = os.Open("main.go")
	if err != nil {
		fmt.Println("open file failed reason:" + err.Error())
	}
	defer f.Close()
	var content = []byte{}
	// 文件的内容往切片里填充，填充的量不会超过切片的长度(注意不是容量)
	var buf = make([]byte, 100)
	for {
		n, err := f.Read(buf)
		if n > 0 {
			content = append(content, buf[:n]...)
		}
		if err != nil {
			break
		}
	}
	fmt.Println(string(content))

	// 异常与捕捉
	fmt.Println(fact(5))

	defer func() {
		if err := recover(); err != nil {
			fmt.Println("error cached,", err)
			fmt.Printf("%T\n", err)
		}
	}()

	fmt.Println(fact(-5))

}

func fact(a int) int {
	if a <= 0 {
		panic(negErr)
	}
	var r = 1
	for i := 0; i <= a; i++ {
		r *= i
	}
	return r
}