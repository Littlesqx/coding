package main

import (
	"strings"
	"io"
	"fmt"
	"os"
	"bytes"
	r "./reader"
	w "./writer"
)

func main() {
	reader := strings.NewReader("Golang is best.");
	p := make([]byte, 4)
	for {
		n, err := reader.Read(p)
		if err != nil {
			if err == io.EOF {
				fmt.Println("EOF:", n)
				break;
			}
			fmt.Println(err)
			os.Exit(1)
		}
		fmt.Println(n, string(p[:n]))
	}

	alphaReader := r.NewAlphaReader("Golang is best. Go 语言是最好的！")
	ap := make([]byte, 4)
	for {
		n, err := alphaReader.Read(ap)
		if err != nil {
			if err == io.EOF {
				fmt.Println("EOF:", n)
				break;
			}
			fmt.Println(err)
			os.Exit(1)
		}
		fmt.Println(n, string(ap[:n]))
	}


	// io.Writer
	proverbs := []string {
		"Channels orchestrate mutexe mutexes serialize",
		"Cgo is not Go",
		"Errors are values",
		"Don't panic",
	}
	var writer bytes.Buffer

	for _, p := range proverbs {
		n, err := writer.Write([]byte(p))
		if err != nil {
			fmt.Println(err)
			os.Exit(1)
		}
		if n != len(p) {
			fmt.Println("failed to write data.")
			os.Exit(1)
		}
	}
	fmt.Println(writer.String())

	chanWriter := w.NewChanWriter()
	go func() {
		defer chanWriter.Close()
		chanWriter.Write([]byte("Stream "))
		chanWriter.Write([]byte("me!"))
	}()
	for c := range chanWriter.Chan() {
		fmt.Printf("%c", c)
	}
	fmt.Println()

	// os.File
	text := []string {
		"Channels orchestrate mutexe mutexes serialize\n",
		"Cgo is not Go\n",
		"Errors are values\n",
		"Don't panic\n",
	}
	file, err := os.Create("./text.txt")
	if err != nil {
		fmt.Println(err)
		os.Exit(1)
	}
	defer file.Close()

	for _, p := range text {
		n, err := file.Write([]byte(p))
		if err != nil {
			fmt.Println(err)
			os.Exit(1)
		}
		if n != len(p) {
			fmt.Println("failed ti write data.")
			os.Exit(1)
		}
	}
	fmt.Println("file wirte done!")

	readFile, err := os.Open("./text.txt")
	if err != nil {
		fmt.Println(err)
		os.Exit(1)
	}
	defer readFile.Close()
	rp := make([]byte, 4)
	for {
		n, err := readFile.Read(rp)
		if err != nil {
			if err == io.EOF {
				break;
			} else {
				fmt.Println(err)
			}
		}
		fmt.Printf(string(rp[:n]))
	}
	fmt.Println()

	// os.Stdout os.Stdin os.Stderr

	fmt.Printf("============ os.Std ============\n")
	t1 := []string{
		"Channels orchestrate mutexes serialize\n",
        "Cgo is not Go\n",
        "Errors are values\n",
        "Don't panic\n",
	}
	for _, tp := range t1 {
		n, err := os.Stdout.Write([]byte(tp))
		if err != nil {
			fmt.Println(err)
			os.Exit(1)
		}
		if n != len(tp) {
			fmt.Println("failed to write data.")
			os.Exit(1)
		}
	}

	var b [512]byte
	n, err := os.Stdin.Read(b[:])
	if err != nil {
		fmt.Println(err)
		return
	}
	fmt.Println("count:", n, "content:", string(b[:]))
}