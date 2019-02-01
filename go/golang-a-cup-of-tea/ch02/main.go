// see 《快学 Go 语言》第 2 课 —— 变量什么的最讨厌了

package main

import "fmt"

var globali int = 42

func main()  {
	// Declare variables
	// 方式一
	var s1 int = 42
	fmt.Println(s1, "s1")
	// 方式二
	var s2 = 42
	fmt.Println(s2, "s2")
	// 方式三
	s3 := 42
	fmt.Println(s3, "s3")

	// Global and local variable
	var locali int = 24
	fmt.Println(globali, "globali")
	fmt.Println(locali, "locali")

	// Var and const
	const consti = 24
	fmt.Println(consti, "consti")

	// Pointer
	var v int = 42
	var p *int = &v
	fmt.Println(p, *p)
	var p1 *int = &v
	var p2 **int = &p1
	var p3 ***int = &p2
	fmt.Println(p1, p2, p3)
	fmt.Println(*p1, **p2, ***p3)

	// Types
	// 有符号整数
	var a int8 = 1
	var b int16 = 2
	var c int32 = 3
	var d int64 = 4
	fmt.Println(a, b, c, d)
	// 在 32 位机器上占 4 个字节，64 位机器上占 8 个字节
	var e int = 5
	// 无符号整数
	var ua uint8 = 1
	var ub uint16 = 2
	var uc uint32 = 3
	var ud uint64 = 4
	fmt.Println(ua, ub, uc, ud)
	// 在 32 位机器上占 4 个字节，64 位机器上占 8 个字节
	var ue uint = 5
	fmt.Println(e, ue)
	// 布尔类型
	var f bool = true
	fmt.Println(f)
	// 字节类型
	var j byte = 'a'
	fmt.Println(j)
	// 字符串类型
	var g string = "abcdefg"
	fmt.Println(g)
	// 浮点数
	var h float32 = 3.14
	var i float64 = 3.141592653
	fmt.Println(h, i)
}