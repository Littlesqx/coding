// see 《快学 Go 语言》第 3 课 —— 分支与循环

package main

import "fmt"

func main() {
	// if else
	fmt.Println(max(24, 42), min(24, 42))
	// switch
	fmt.Println(prize1(60))
	fmt.Println(prize2(60))
	// loop
	echo()
}

func max(a int, b int) int {
	if a > b {
		return a
	}
	return b
}

func min(a int, b int) int {
	if a < b {
		return a
	}
	return b
}

func prize1(score int) string {
	switch score / 10 {
	case 0, 1, 2, 3, 4, 5:
		return "差"
	case 6, 7:
		return "及格"
	case 8: 
		return "良"
	default:
		return "优"			
	}
}

func prize2(score int) string {
	switch  {
	case score < 60:
		return "差"
	case score < 80:
		return "及格"
	case score < 90:
		return "良"
	default:
		return "优"
	}
}

func echo()  {
	for i := 0; i < 10; i++ {
		fmt.Println("hello", i)
	}
}