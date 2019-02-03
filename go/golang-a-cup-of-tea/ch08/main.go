// see 《快学 Go 语言》第 8 课 —— 程序大厦是如何构建起来的

package main

import "fmt"
import "unsafe"
import "math"

type Circle struct {
	x int
	y int
	Radius int
}

type ArrayStruct struct {
	v [10]int
}

type SliceStruct struct {
	v []int
}

type Point struct {
	x int
	y int
}

type Circle2 struct {
	loc Point
	Radius int
}

type Circle3 struct {
	Point
	Radius int
}

func (p Point) show() {
	fmt.Println(p.x, p.y)
}

func (c Circle3) showSelf() {
	fmt.Println(c.Radius)
}

func main() {
	// 创建结构体 一
	var c1 Circle = Circle {
		x: 100,
		y: 100,
		Radius: 50,
	}
	fmt.Printf("%+v\n", c1)
	// 创建结构体 二
	var c2 Circle = Circle {100, 100, 50}
	fmt.Printf("%+v\n", c2)

	// 指针形式
	var c3 *Circle = &Circle {100, 100, 50}
	fmt.Printf("%+v\n", c3)

	// 创建结构体 三
	var c4 *Circle = new(Circle) // 返回指针形式，零值结构体
	fmt.Printf("%+v\n", c4)

	// 创建零值结构体的三种方式
	// var c1 Circle = Circle {}
	// var c2 Circle
	// var c3 *Circle = new(Circle)

	// 零值结构体和 nil 结构体
	// VS var c *Circle = nil
	// nil 结构体是指结构体指针变量没有指向一个实际存在的内存。
	// 占用一个指针的存储空间

	// 结构体的内存大小
	var cn *Circle = nil
	fmt.Println(unsafe.Sizeof(c1))
	fmt.Println(unsafe.Sizeof(cn))

	// 结构体的拷贝
	copy()

	// 结构体中的数组和切片
	var as = ArrayStruct {[...]int {0, 1, 2, 3, 4, 5, 6, 7, 8, 9}}
	var ss = SliceStruct {[]int {0, 1, 2, 3, 4, 5, 6, 7, 8, 9}}
	fmt.Println(unsafe.Sizeof(as), unsafe.Sizeof(ss))

	// 结构体的参数传递
	// 支持值传递，也支持指针传递。
	// 值传递涉及到结构体字段的浅拷贝，指针传递会共享结构体内容，只会拷贝指针地址，规则上和赋值是等价的。

	// 结构体方法
	c2.PrintArea()

	// 结构体的指针方法
	c2.expand()
	c2.PrintArea()

	// 通过指针访问内部的字段需要 2 次内存读取操作，
	// 第一步是取得指针地址，第二部是读取地址的内容，它比值访问要慢。
	// 但是在方法调用时，指针传递可以避免结构体的拷贝操作，结构体比较大时，这种性能的差距就会比较明显。

	// 还有一些特殊的结构体它不允许被复制，比如结构体内部包含有锁时，这时就必须使用它的指针形式来定义方法，否则会发生一些莫名其妙的问题。


	// 内嵌结构体
	var ic = Circle2 {
		loc: Point {
			x: 100,
			y: 100,
		},
		Radius: 50,
	}
	fmt.Printf("%+v\n", ic)

	// 匿名内嵌结构体
	var nic = Circle3 {
		Point: Point {
			x: 100,
			y: 100,
		},
		Radius: 50,
	}
	nic.show()
	nic.Point.show()
}

func (c Circle) Area() float64 {
	return math.Pi * float64(c.Radius) * float64(c.Radius)
}

func (c Circle) PrintArea() {
	fmt.Println("The area is", c.Area())
}

func (c *Circle) expand() {
	c.Radius *= 2
}

func copy() {
	var c1 Circle = Circle {Radius: 50}
	var c2 Circle = c1
	fmt.Printf("%+v\n", c1)
	fmt.Printf("%+v\n", c2)
	c1.Radius = 100
	fmt.Printf("%+v\n", c1)
	fmt.Printf("%+v\n", c2)

	var c3 *Circle = &Circle {Radius: 50}
	var c4 *Circle = c3
	fmt.Printf("%+v\n", c3)
	fmt.Printf("%+v\n", c4)
	c3.Radius = 100
	fmt.Printf("%+v\n", c3)
	fmt.Printf("%+v\n", c4)
}