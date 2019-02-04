// see 《快学 Go 语言》第 9 课 —— 接口

package main

import "fmt"

type Smellable interface {
	smell()
}

type Eatable interface {
	eat()
}

type Apple struct {

}

type Flower struct {

}

func (a Apple) smell() {
	fmt.Println("apple can be smell.")
}

func (a Apple) eat() {
	fmt.Println("apple can be eaten.")
}

func (f Flower) smell() {
	fmt.Println("flower can be smell.")
}

type Fruitable interface {
	eat()
}

type Fruit struct {
	Name string
	Fruitable
}

func (f Fruit) want() {
	f.eat()
}

type Banana struct {}

func (v Banana) eat() {
	fmt.Println("banana can be eaten.")
}

type Rect struct {
	Width int
	Height int
}

func main() {
	var s1 Smellable
	var s2 Eatable
	var apple = Apple {}
	var flower = Flower {}
	s1 = apple
	s1.smell()
	s1 = flower
	s1.smell()
	s2 = apple
	s2.eat()

	// 空接口
	var user = map[string]interface{} {
		"age": 30,
		"address": "Beijing Tongzhou",
		"married": true,
	}
	fmt.Println(user)

	var age = user["age"].(int)
	var address = user["address"].(string)
	var married = user["married"].(bool)
	fmt.Println(age, address, married)

	// 接口变量的本质
	// 类型指针 + 数据指针

	// 接口模拟多态
	var f1 = Fruit{"Apple", Apple{}}
	var f2 = Fruit{"Banana", Banana{}}
	f1.want()
	f2.want()

	// 接口变量的赋值
	var aq interface {}
	var rq  = Rect {50, 50}
	aq = rq // 会发生数据内存的复制

	var rx = aq.(Rect) // 会发生数据内存的复制
	rq.Width = 100
	rq.Height = 100
	fmt.Println(rx)

	// 指向指针的接口变量
	var aq2 interface {}
	aq2 = &rq

	var rx2 = aq2.(*Rect)
	rq.Width = 100
	rq.Height = 100
	fmt.Println(rx2)
}