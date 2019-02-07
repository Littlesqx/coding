// 《快学 Go 语言》第 13 课 —— 并发与安全

package main

import "fmt"
import "sync"

type SafeDict struct {
	data map[string]int
	mutex *sync.Mutex
}

func (d *SafeDict) Len() int {
	d.mutex.Lock()
	defer d.mutex.Unlock()
	return len(d.data)
}

func (d *SafeDict) Put(key string, value int) (int, bool) {
	d.mutex.Lock()
	defer d.mutex.Unlock()
	oldValue, ok := d.data[key]
	d.data[key] = value
	return oldValue, ok
}

func (d *SafeDict) Get(key string) (int, bool) {
	d.mutex.Lock()
	defer d.mutex.Unlock()
	value, ok := d.data[key]
	return value, ok
}

func (d *SafeDict) Delete(key string) (int, bool) {
	d.mutex.Lock()
	defer d.mutex.Unlock() // 如果函数运行时间长，锁持有时间过长
	oldValue, ok := d.data[key]
	if ok {
		delete(d.data, key)
	}
	return oldValue, ok
}

func write(d map[string]int) {
	d["fruit"] = 2
}

func safeWrite(d *SafeDict) {
	d.Put("banana", 1)
}

func read(d map[string] int) {
	fmt.Println(d["fruit"])
}

func safeRead(d *SafeDict) {
	fmt.Println(d.Get("banana"))
}

func main() {
	// 非线程安全
	// d := map[string]int {}
	// go read(d)
	// write(d)

	// 线程安全
	dd := &SafeDict {
		data: map[string]int {
			"apple": 2,
		},
		mutex: &sync.Mutex {},
	}

	go safeRead(dd)
	safeWrite(dd)

	// 避免锁复制
	// sync.Mutex 尽可能使用指正类型

	// 使用读写锁
	// ./rw-mutex/main.go
}