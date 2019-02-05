package main

import "fmt"
import "time"

func main() {
	fmt.Println("run in main goroutine")
	go func() {
		fmt.Println("run in child goroutine")
		go func() {
			fmt.Println("run in grand child goroutine")
			go func() {
				fmt.Println("run in grand grand child goroutine")
			}()
		}()
	}()
	time.Sleep(time.Second)
	fmt.Println("main goroutine will quit")
	// 协程之间并不存在这么多的层级关系，在 Go 语言里只有一个主协程，其它都是它的子协程，子协程之间是平行关系。
	// 为了保护子协程的安全，通常我们会在协程的入口函数开头增加 recover() 语句来恢复协程内部发生的异常，
	// 阻断它传播到主协程导致程序崩溃。recover 语句必须写在 defer 语句里面。
	// 
	// 线程的调度是由操作系统负责的，调度算法运行在内核态，而协程的调用是由 Go 语言的运行时负责的，调度算法运行在用户态。
	// 协程可以简化为三个状态，运行态、就绪态和休眠态。
	// 同一个线程中最多只会存在一个处于运行态的协程，就绪态的协程是指那些具备了运行能力但是还没有得到运行机会的协程，
	// 它们随时会被调度到运行态，休眠态的协程还不具备运行能力，
	// 它们是在等待某些条件的发生，比如 IO 操作的完成、睡眠时间的结束等。
}	