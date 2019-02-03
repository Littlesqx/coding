// see 《快学 Go 语言》第 6 课 —— 字典

package main

import "fmt"
import "unsafe"

func main()  {
	// 创建字典
	var m1 map[int]string = make(map[int]string) // 指定第二个参数，提前分配内存
	fmt.Println(m1, len(m1))
	var m2 map[int]string = map[int]string {
		90: "优秀",
		80: "良好",
		60: "及格",
	}
	fmt.Println(m2, len(m2))

	// 字典读写
	var fruits = map[string]int {
		"apple": 2,
		"banana": 5,
		"orange": 8,
	}
	// 读取元素
	var score = fruits["apple"]
	fmt.Println(score)
	// 增加或修改元素
	fruits["pear"] = 3
	fmt.Println(fruits)
	// 删除元素
	delete(fruits, "pear")
	fmt.Println(fruits)

	// 判断 key 是否存在
	// 读操作时，如果 key 不存在，也不会抛出异常。
	// 它会返回 value 类型对应的零值。
	// 如果是字符串，对应的零值是空串，如果是整数，对应的零值是 0，如果是布尔型，对应的零值是 false。
	var v, ok = fruits["durin"]
	if ok {
		fmt.Println(v)
	} else {
		fmt.Println("durin not exists")
	}
	fruits["durin"] = 1
	v, ok = fruits["durin"]
	if ok {
		fmt.Println(v)
	} else {
		fmt.Println("durin not exists")
	}

	// 遍历字典
	for name, value := range fruits {
		fmt.Println(name, value)
	}
	for name := range fruits {
		fmt.Println(name)
	}

	// 变量大小
	fmt.Println(unsafe.Sizeof(fruits))
}