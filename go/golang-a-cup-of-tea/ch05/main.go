// see 《快学 Go 语言》第 5 课 —— 灵活的切片

package main

import "fmt"

func main()  {
	var s1 []int = make([]int, 5, 8) // 参数：类型，长度，容量
	var s2 []int = make([]int, 8) 	 // 满容切片（长度等于容量）
	fmt.Println(s1)
	fmt.Println(s2)

	// 初始化
	var s []int = []int{1, 2, 3, 4, 5} // 满容
	fmt.Println(s, len(s), cap(s))

	// 空切片
	var e1 []int // nil 切片
	var e2 []int = []int{}
	var e3 []int = make([]int, 0)
	fmt.Println(e1, e2, e3)
	fmt.Println(len(e1), len(e2), len(e3))
	fmt.Println(cap(e1), cap(e2), cap(e3))

	// 切片的赋值
	var t1 = make([]int, 5, 8)
	// 切片的访问和数组类似
	for i := 0; i < len(t1); i++ {
		t1[i] = i + 1
	}
	// 切片的赋值是浅拷贝
	var t2 = t1
	fmt.Println(t1, len(t1), cap(t1))
	fmt.Println(t2, len(t2), cap(t2))
	// 尝试修改切片的内容
	t2[0] = 255
	fmt.Println(t1)
	fmt.Println(t2)

	// 切片的遍历和数组一样：下标访问和 range 遍历

	// 切片的追加
	var a1 = []int{1, 2, 3, 4, 5}
	fmt.Println(a1, len(a1), cap(a1))
	// 对满容的切片进行追加会分离底层数组
	var a2 = append(a1, 6)
	fmt.Println(a1, len(a1), cap(a1))
	fmt.Println(a2, len(a2), cap(a2))
	// 对非满容的切片进行追加会共享底层数组
	var a3 = append(a2, 7)
	fmt.Println(a2, len(a2), cap(a2))
	fmt.Println(a3, len(a3), cap(a3))

	// 切割切割
	var ss = []int{1, 2, 3, 4, 5, 6, 7}
	// start_index 和 end_index（结果不包含 end_index），不支持负数
	var ss1 = ss[2:5]
	fmt.Println(ss, len(ss), cap(ss))
	fmt.Println(ss1, len(ss1), cap(ss1))
	var ss2 = ss[:5]
	var ss3 = ss[3:] // 指针从下标 3 开始，容量是 ４
	var ss4 = ss[:]  // 和普通的切片赋值没有区别
	fmt.Println(ss2, len(ss2), cap(ss2))
	fmt.Println(ss3, len(ss3), cap(ss3))
	fmt.Println(ss4, len(ss4), cap(ss4))

	// 数组变切片
	// 对数组进行切割可以转换成切片，切片将原数组作为内部底层数组。其中之一修改会影响到另一个

	// copy 函数进行深拷贝
	// func copy(dst, src []T) int
	// 返回拷贝的实际长度 =  min(len(src), len(dst))

	// 切片的扩容点
	l1 := make([]int, 6)
	fmt.Println(l1)
	l2 := make([]int, 1024)
	fmt.Println(l2)
	l1 = append(l1, 1) // 扩容增加一倍容量
	l2 = append(l2, 1) // 原容量 >= 1024，扩容看底层策略，一般 1/4
	fmt.Println(len(l1), cap(l1))
	fmt.Println(len(l2), cap(l2))
}