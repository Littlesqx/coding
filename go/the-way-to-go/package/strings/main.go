package main

import (
	"strings"
	"fmt"
)

func main() {
	s := "你你你好啊，世界！Heeeeeeeeeeello, world!"
	// Count
	fmt.Println(strings.Count(s, "你"))
	fmt.Println(strings.Count(s, "你你"))
	// Contains
	fmt.Println(strings.Contains(s, "你"))
	fmt.Println(strings.Contains(s, "您"))
	// ContainsAny
	fmt.Println(strings.ContainsAny(s, "abc"))
	fmt.Println(strings.ContainsAny(s, "efg"))
	// ContainsRune
	fmt.Println(strings.ContainsRune(s, 'e'))
	fmt.Println(strings.ContainsRune(s, 'a'))
	// Index
	fmt.Println(strings.Index(s, "你"))
	fmt.Println(strings.Index(s, "好"))
	fmt.Println(strings.Index(s, ""))
	// LastIndex
	fmt.Println(strings.LastIndex(s, "h"))
	fmt.Println(strings.LastIndex(s, "你"))
	fmt.Println(strings.LastIndex(s, ""))
	fmt.Println(len(s))
	// IndexAny
	fmt.Println(strings.IndexAny(s, "abc"))
	fmt.Println(strings.IndexAny(s, "你"))
	fmt.Println(strings.IndexAny(s, ""))
	// LastIndexAny
	fmt.Println(strings.LastIndexAny(s, "abc"))
	fmt.Println(strings.LastIndexAny(s, "你"))
	fmt.Println(strings.LastIndexAny(s, ""))
}