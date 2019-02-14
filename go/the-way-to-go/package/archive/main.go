// archive/tar 和 /zip-compress：压缩(解压缩)文件功能。

package main

import (
	"archive/tar"
	// "archive/zip"
	"fmt"
	"os"
	"io"
)

func main() {
	fmt.Println("header:")
	header()
	fmt.Println("writer:")
	writer()
	fmt.Println("reader:")
	reader()
}

func header() {

	// type Header // 该结构体代表了一个tar归档的头部，一些字段可能不被填充，Header中主要包含文件相关信息。

	// type Header struct {
	// 	Name       string    // 记录头域的文件名
	// 	Mode       int64     // 权限和模式位
	// 	Uid        int       // 所有者的用户ID
	// 	Gid        int       // 所有者的组ID
	// 	Size       int64     // 字节数（长度）
	// 	ModTime    time.Time // 修改时间
	// 	Typeflag   byte      // 记录头的类型
	// 	Linkname   string    // 链接的目标名
	// 	Uname      string    // 所有者的用户名
	// 	Gname      string    // 所有者的组名
	// 	Devmajor   int64     // 字符设备或块设备的major number
	// 	Devminor   int64     // 字符设备或块设备的minor number
	// 	AccessTime time.Time // 访问时间
	// 	ChangeTime time.Time // 状态改变时间
	// 	Xattrs     map[string]string
	// }

	fileinfo, err := os.Stat("./main.go")
	if err != nil {
		fmt.Println(err)
		return
	}
	header, err := tar.FileInfoHeader(fileinfo, "")
	if err != nil {
		fmt.Println(err)
	}
	fmt.Println(
		header.AccessTime, 
		header.ChangeTime, 
		header.ModTime, 
		header.Devminor, 
		header.Gid,
		header.Name,
		header.Size,
		header.Gname,
	)
}

func reader() {

	// 解压缩包的方法，从 .tar 文件中读出数据是通过 tar.Reader 完成的，
	// 所以首先要创建 tar.Reader，可以通过 tar.NewReader 方法来创建它，
	// 该方法要求提供一个 os.Reader 对象，以便从该对象中读出数据。
	
	// type Reader struct {
	// 	// 内含隐藏或非导出字段
	// }

	f, err := os.Open("./main.test.tar")
	if err != nil {
		fmt.Println(err)
		return
	}
	defer f.Close()
	r := tar.NewReader(f)
	for hdr, err := r.Next(); err != io.EOF; hdr, err = r.Next() {
		if err != nil {
			fmt.Println(err)
		}
		fileinfo := hdr.FileInfo()
		fmt.Println(fileinfo.Name())
		f, err := os.Create("./copy/" + fileinfo.Name())
		if err != nil {
			fmt.Println(err)
		}
		defer f.Close()
		_, err = io.Copy(f, r)
		if err != nil {
			fmt.Println(err)
		}
	}
}

func writer() {
	// type Writer struct {
	// 	// 内含隐藏或非导出字段
	// }
	f, err := os.Create("./main.test.tar")
	if err != nil {
		fmt.Println(err)
		return
	}
	defer f.Close()
	tw := tar.NewWriter(f)
	defer tw.Close()
	fileinfo, err := os.Stat("./main.test")
	if err != nil {
		fmt.Println(err)
	}
	hdr, err := tar.FileInfoHeader(fileinfo, "")
	if err != nil {
		fmt.Println(err)
	}
	err = tw.WriteHeader(hdr)
	if err != nil {
		fmt.Println(err)
	}
	file, err := os.Open("./main.test")
	if err != nil {
		fmt.Println(err)
		return
	}
	m, err := io.Copy(tw, file)
	if err != nil {
		fmt.Println(err)
	}
	fmt.Println(m)
}