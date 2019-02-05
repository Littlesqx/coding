package main

import (
	"fmt"
	"time"
)

func main() {
	var ch1 = make(chan int)
	var ch2 = make(chan int)
	// var ch3 = make(chan int)
	// 多路通道
	go send(ch1, time.Second)
	go send(ch2, time.Second * 2)
	// 将多个原通道内容拷贝到单一的目标通道
	// go collect(ch1, ch3)
	// go collect(ch2, ch3)
	// recv(ch3)

	// select 语法糖
	recv2(ch1, ch2)
}

func send(ch chan int, gap time.Duration) {
	i := 0
	for {
		i++
		ch <- i
		time.Sleep(gap)
	}
}

func collect(source chan int, target chan int) {
	for v := range source {
		target <- v
	}
}

func recv(ch chan int) {
	for v := range ch {
		fmt.Printf("receive %d\n", v)
	}
}

func recv2(ch1 chan int, ch2 chan int) {
	for {
		select {
			case v := <- ch1:
				fmt.Printf("recv %d from ch1\n", v)
			case v := <- ch2:
				fmt.Printf("recv %d from ch2\n", v)
			default: // 非阻塞；读不到则丢弃，反之写也是同理
		}
	}
}