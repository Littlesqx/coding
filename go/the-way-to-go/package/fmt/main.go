// mt包实现了类似C语言printf和scanf的格式化I/O。格式化动作（'verb'）源自C语言但更简单。

package main

import (
	"fmt"
)

type test struct {
	k string
	v string
}

func main() {
	var t bool = true
	var s string = "i am true"
	var st test = test {
		"k",
		"v",
	}
	// Printing
	// 通用
	// %v	值的默认格式表示
	// %+v	类似%v，但输出结构体时会添加字段名
	// %#v	值的Go语法表示
	// %T	值的类型的Go语法表示
	// %%	百分号
	fmt.Printf("%%v: %v\n", t)
	fmt.Printf("%%+v: %+v\n", t)
	fmt.Printf("%%#v: %#v\n", t)
	fmt.Printf("%%T: %T\n", t)
	fmt.Printf("%%t: %t\n", t)
	fmt.Printf("%%#t: %#v\n", s)
	fmt.Printf("%%T: %T\n", s)
	fmt.Printf("%%q: %q\n", s)
	fmt.Printf("%%x: %x\n", s)
	fmt.Printf("%%X: %X\n", s)
	fmt.Printf("%%v: %v\n", st)
	fmt.Printf("%%+v: %+v\n", st)
	fmt.Printf("%%#t: %#v\n", st)
	fmt.Printf("%%T: %T\n", st)
	// 布尔值
	// %t	单词 true 或 false
	// 整数
	// %b	表示为二进制
	// %c	该值对应的unicode码值
	// %d	表示为十进制
	// %o	表示为八进制
	// %q	该值对应的单引号括起来的go语法字符字面值，必要时会采用安全的转义表示
	// %x	表示为十六进制，使用a-f
	// %X	表示为十六进制，使用A-F
	// %U	表示为Unicode格式：U+1234，等价于"U+%04X"
	// 浮点数与复数的两个组分
	// %b	无小数部分、二进制指数的科学计数法，如-123456p-78；参见strconv.FormatFloat
	// %e	科学计数法，如-1234.456e+78
	// %E	科学计数法，如-1234.456E+78
	// %f	有小数部分但无指数部分，如123.456
	// %F	等价于%f
	// %g	根据实际情况采用%e或%f格式（以获得更简洁、准确的输出）
	// %G	根据实际情况采用%E或%F格式（以获得更简洁、准确的输出）
	// 字符串和[]byte
	// %s	直接输出字符串或者[]byte
	// %q	该值对应的双引号括起来的go语法字符串字面值，必要时会采用安全的转义表示
	// %x	每个字节用两字符十六进制数表示（使用a-f）
	// %X	每个字节用两字符十六进制数表示（使用A-F）
	var scan string
	n, err := fmt.Scanf("%s", &scan)
	if err != nil {
		fmt.Println(err)
		return
	}
	fmt.Println(n)
}