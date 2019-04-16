package sd

import (
	"fmt"
	"github.com/gin-gonic/gin"
	"github.com/shirou/gopsutil/cpu"
	"github.com/shirou/gopsutil/disk"
	"github.com/shirou/gopsutil/load"
	"github.com/shirou/gopsutil/mem"
	"net/http"
)

const (
	B  = 1
	KB = 1024 * B
	MB = 1024 * KB
	GB = 1024 * MB
)

func HealthCheck(c *gin.Context) {
	message := "OK"
	c.String(http.StatusOK, message)
}

func DiskCheck(c *gin.Context) {
	u, _ := disk.Usage("/")
	usedMB, usedGB, totalMB, totalGB := int(u.Used)/MB, int(u.Used)/GB, int(u.Total)/MB, int(u.Total)/GB
	usedPercent := int(u.UsedPercent)

	status, text := http.StatusOK, "OK"

	if usedPercent >= 95 {
		status = http.StatusInternalServerError
		text = "CRITICAL"
	} else if usedPercent >= 90 {
		status = http.StatusTooManyRequests
		text = "WARNING"
	}
	message := fmt.Sprintf("%s - Free space: %dMB (%dGB) / %dMB (%dGB) | Used: %d%%", text, usedMB, usedGB, totalMB, totalGB, usedPercent)
	c.String(status, message)
}

func CPUCheck(c *gin.Context) {
	cores, _ := cpu.Counts(false)
	a, _ := load.Avg()
	l1, l5, l15 := a.Load1, a.Load5, a.Load15
	status, text := http.StatusOK, "OK"
	if l5 >= float64(cores-1) {
		status = http.StatusInternalServerError
		text = "CRITICAL"
	} else if l5 >= float64(cores-2) {
		status = http.StatusTooManyRequests
		text = "WARNING"
	}
	message := fmt.Sprintf("%s - Load average: %.2f, %.2f, %.2f | Cores: %d", text, l1, l5, l15, cores)
	c.String(status, message)
}

func RAMCheck(c *gin.Context) {
	u, _ := mem.VirtualMemory()
	usedMB, usedGB, totalMB, totalGB := int(u.Used)/MB, int(u.Used)/GB, int(u.Total)/MB, int(u.Total)/GB
	usedPercent := int(u.UsedPercent)

	status, text := http.StatusOK, "OK"

	if usedPercent >= 95 {
		status = http.StatusInternalServerError
		text = "CRITICAL"
	} else if usedPercent >= 90 {
		status = http.StatusTooManyRequests
		text = "WARNING"
	}
	message := fmt.Sprintf("%s - Free space: %dMB (%dGB) / %dMB (%dGB) | Used: %d%%", text, usedMB, usedGB, totalMB, totalGB, usedPercent)
	c.String(status, message)
}
