// see 《快学 Go 语言》第 4 课 —— 低调的数组

package main

import "fmt"

func main()  {
	var v [9]int
	fmt.Println(v)

	var a = [9]int{1, 2, 3, 4, 5, 6, 7, 8, 9}
	var b [9]int = [9]int{1, 2, 3, 4, 5, 6, 7, 8, 9}
	c := [9]int{1, 2, 3, 4, 5, 6, 7, 8, 9}
	fmt.Println(a)
	fmt.Println(b)
	fmt.Println(c)

	var squares [9]int
	for i := 0; i < len(squares); i++ {
		squares[i] = (i + 1) * (i + 1)
	}
	fmt.Println(squares)

	// 下标越界检查：静态下标访问编译期检查；动态下标访问运行时检查（加入了额外的检查代码，性能有所损耗）

	// 相同类型和长度的数组方可赋值，否则不是一类数组，不能赋值。
	// 数组赋值只是浅拷贝？

	var s = [5]int{1, 2, 3, 4, 5}
	for index := range s {
		fmt.Println(index, a[index])
	}
	for index, value := range s {
		fmt.Println(index, value)
	}
}