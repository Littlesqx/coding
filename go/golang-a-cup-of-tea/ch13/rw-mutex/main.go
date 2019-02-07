package main

import "fmt"
import "sync"

type SafeDict struct {
	data map[string]int
	*sync.RWMutex
}

func (d *SafeDict) Len() int {
	d.RLock() // 读锁是共享锁，加读锁还可以允许其它协程再加读锁，但是会阻塞加写锁。
	defer d.RUnlock()
	return len(d.data)
}

func (d *SafeDict) Put(key string, value int) (int, bool) {
	d.Lock()
	defer d.Unlock()
	oldValue, ok := d.data[key]
	d.data[key] = value
	return oldValue, ok
}

func (d *SafeDict) Get(key string) (int, bool) {
	d.RLock()
	defer d.RUnlock()
	value, ok := d.data[key]
	return value, ok
}

func (d *SafeDict) Delete(key string) (int, bool) {
	d.Lock()
	defer d.Unlock() // 如果函数运行时间长，锁持有时间过长
	oldValue, ok := d.data[key]
	if ok {
		delete(d.data, key)
	}
	return oldValue, ok
}

func write(d *SafeDict) {
	d.Put("banana", 1)
}

func read(d *SafeDict) {
	fmt.Println(d.Get("banana"))
}

func main() {
	d := &SafeDict {
		map[string]int {
		"apple": 2,
		"pear":  3,
		},
		&sync.RWMutex {},
	}
	go read(d)
	write(d)
}