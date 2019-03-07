package config

import (
	"log"
	"strings"
	"github.com/fsnotify/fsnotify"
	"github.com/spf13/viper"
)

type Config struct {
	Name string
}

func (c *Config) initConfig() error {
	if c.Name != "" {
		viper.SetConfigFile(c.Name)
	} else {
		viper.AddConfigPath(".")
		viper.SetConfigName("config")
	}
	viper.SetConfigType("yaml")
	viper.AutomaticEnv()			// 读取匹配的环境变量
	viper.SetEnvPrefix("APISERVER")	// 读取环境变量的前缀为 APISERVER
	replacer := strings.NewReplacer(".", "_")
	viper.SetEnvKeyReplacer(replacer)
	return viper.ReadInConfig() // nil|error
}

func (c *Config) watchConfig() {
	viper.WatchConfig()
	viper.OnConfigChange(func(e fsnotify.Event) {
		log.Printf("Config file changed: %s", e.Name)
	})
}

func Init(config string) error {
	c := Config {
		Name: config,
	}
	if err := c.initConfig(); err != nil {
		return err
	}
	
	c.watchConfig()

	return nil
}

