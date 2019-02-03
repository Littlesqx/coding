// see 《快学 Go 语言》第 7 课 —— 字符串

package main

import "fmt"

func main()  {
	// 字符串通常有两种设计，一种是「字符」串，一种是「字节」串。
	// 「字符」串中的每个字都是定长的，而「字节」串中每个字是不定长的。
	// Go 语言里的字符串是「字节」串，英文字符占用 1 个字节，非英文字符占多个字节。
	// 我们所说的字符通常是指 unicode 字符，你可以认为所有的英文和汉字在 unicode 字符集中都有一个唯一的整数编号，一个 unicode 通常用 4 个字节来表示，对应的 Go 语言中的字符 rune 占 4 个字节。
	var s1 = "嘻哈china"
	// 字节遍历
	for i := 0; i < len(s1); i++ {
		fmt.Printf("%x ", s1[i])
	}
	fmt.Println()
	// 字符 rune 遍历
	for codepoint, runeValue := range s1 {
		fmt.Printf("%d %d", codepoint, int32(runeValue))
	}
	// codepoint 表示字符起始位置，runeValue 表示对应的 unicode 编码（类型是 rune）

	fmt.Println()

	// 字节串内存表示
	var s3 = "hello" // 静态字面量
	var s2 = ""
	for i := 0; i < 10; i++ {
  		s2 += s3 // 动态构造
	}
	fmt.Println(len(s3))
	fmt.Println(len(s2))
	//	--------------
	// 	- 指针 - 长度 -
	//	--------------
	// 
	// 字符串的复制是浅拷贝，底层字节数组共享

	// 字符串是只读的（通过下标方式）

	// 切割切割
	var s4 = "哈hello world"
	var s5 = s4[3:8]
	fmt.Println(s5)

	// 字节切片和字符串的相互转换
	var b = []byte(s4)
	var s6 = string(b)
	fmt.Println(b)
	fmt.Println(s6)
}