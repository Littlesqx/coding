// see 《快学 Go 语言》第 14 课 —— 魔术变性指针

package main

import "fmt"
import "unsafe"

type Rect struct {
	Width int
	Height int
}

func main() {
	var r = Rect {50, 60}
	var width = (*int)(unsafe.Pointer(&r))
	var height = *(*int)(unsafe.Pointer(uintptr(unsafe.Pointer(&r)) + uintptr(8)))
	fmt.Println(&r, uintptr(unsafe.Pointer(&r)), uintptr(8)) // uintptr = 偏移量， = unsafe.Offsetof(r.Height)
	*width = 1
	fmt.Println(*width, height)
	fmt.Println(r)

	// 探究切片结构
	// head = {address, 10, 10}
	// body = [1,2,3,4,5,6,7,8,9,10]
	var s = []int{1,2,3,4,5,6,7,8,9,10}
	var address = (**[10]int)(unsafe.Pointer(&s))
	var len = (*int)(unsafe.Pointer(uintptr(unsafe.Pointer(&s)) + uintptr(8)))
	var cap = (*int)(unsafe.Pointer(uintptr(unsafe.Pointer(&s)) + uintptr(16)))
	fmt.Println(address, *len, *cap, *address, **address)
	var body = **address
	for i:=0; i< 10; i++ {
		fmt.Printf("%d ", body[i])
	}

	// 将结构体变量赋值给接口变量，结构体内存会被复制
	// 将接口变量赋值给接口变量，共享了数据内存  包括不同类型或造型而来的接口
	// 将接口造型成结构体类型，内存会发生复制，它们之间的数据不会共享
}