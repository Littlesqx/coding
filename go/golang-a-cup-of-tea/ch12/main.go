// see 《快学 Go 语言》第 12 课 —— 通道

package main

import (
	"fmt"
	"time"
	"math/rand"
	"sync"
)

func main() {

	// 创建通道

	// 缓冲型通道，第二个参数为容器大小
	// var bufferedChannel = make(chan int, 1024)

	// 非缓冲型通道，处于既满又空的状态
	// 必须确保有协程正在尝试读取当前通道，
	// 否则写操作就会阻塞直到有其它协程来从通道中读东西
	// var unbufferedChannel = make(chan int)

	// 读写通道
	var ch chan int = make(chan int, 4)
	for i := 0; i < cap(ch); i++ {
		ch <- i
	}
	for len(ch) > 0 {
		var value int = <- ch
		fmt.Println(value)
	}
	// 通道满了，写操作就会阻塞，协程就会进入休眠，直到有其它协程读通道挪出了空间，协程才会被唤醒。
	// 如果有多个协程的写操作都阻塞了，一个读操作只会唤醒一个协程。

	// 通道空了，读操作就会阻塞，协程也会进入睡眠，直到有其它协程写通道装进了数据才会被唤醒。
	// 如果有多个协程的读操作阻塞了，一个写操作也只会唤醒一个协程。
	// var ch2 = make(chan int, 1)
	// go recv(ch2, 1)
	// go recv(ch2, 2)
	// send(ch2)


	// 关闭通道
	var ch3 chan int = make(chan int, 4)
	ch3 <- 1
	ch3 <- 2
	close(ch3)

	// 下面的方式不能获知是否读完和关闭
	// value := <- ch3
	// fmt.Println(value)
	// value = <- ch3
	// fmt.Println(value)
	// value = <- ch3
	// fmt.Println(value)
	// value = <- ch3
	// fmt.Println(value)
	// value = <- ch3
	// fmt.Println(value)

	for value := range ch3 {
		fmt.Println(value)
	}

	// 使用 WaitGroup 计数等待指定事件完成
	var ch4 chan int = make(chan int, 4)
	var wg = new(sync.WaitGroup)
	wg.Add(2)
	go send2(ch4, wg)
	go send2(ch4, wg)
	go recv2(ch4)
	wg.Wait() // 计数值为零时 Wait() 才会返回
	close(ch4)
	time.Sleep(time.Second)
}

func send(ch chan int) {
	for {
		var value = rand.Intn(100)
		ch <- value
		fmt.Printf("send %d\n", value)
	}
}

func recv(ch chan int, no int) {
	for {
		var value = <- ch
		fmt.Printf("recv from %d: %d\n", no, value)
		time.Sleep(time.Second)
	}
}

func send2(ch chan int, wg *sync.WaitGroup) {
	defer wg.Done() // 计数值减一
	i := 0
	for i < 4 {
		i++
		ch <- i*10
	}
}

func recv2(ch chan int) {
	for v := range ch {
		fmt.Println(v)
	}
}