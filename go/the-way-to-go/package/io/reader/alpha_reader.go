package reader

import (
	"io"
)

type alphaReader struct {
	src string
	current int
}

func NewAlphaReader(src string) *alphaReader {
	return &alphaReader {src: src}
}

func alpha(r byte) byte {
	if (r >= 'A' && r <= 'Z') || (r >= 'a' && r <= 'z') {
		return r
	}
	return 0
}

func (a *alphaReader) Read(p []byte) (int, error) {
	if a.current >= len(a.src) {
		return 0, io.EOF
	}
	x := len(a.src) - a.current
	n, bound := 0, 0
	if x >= len(p) {
		bound = len(p)
	} else {
		bound = x
	}
	buf := make([]byte, bound)
	for n < bound && a.current < len(a.src) {
		if char := alpha(a.src[a.current]); char != 0 {
			buf[n] = char
			n++;
		}
		a.current++
	}
	copy(p, buf)
	return n, nil;
}