```
├── admin.sh                     # 进程的 start|stop|status|restart 控制文件
├── conf                         # 配置文件统一存放目录
│   ├── config.yaml              # 配置文件
│   ├── server.crt               # TLS 配置文件
│   └── server.key
├── config                       # 专门用来处理配置和配置文件的 Go package
│   └── config.go                 
├── db.sql                       # 在部署新环境时，可以登录 MySQL 客户端，执行 source db.sql 创建数据库和表
├── docs                         # swagger 文档，执行 swag init 生成的
│   ├── docs.go
│   └── swagger
│       ├── swagger.json
│       └── swagger.yaml
├── handler                      # 类似 MVC 架构中的 C，用来读取输入，并将处理流程转发给实际的处理函数，最后返回结果
│   ├── handler.go
│   ├── sd                       # 健康检查 handler
│   │   └── check.go 
│   └── user                     # 核心：用户业务逻辑 handler
│       ├── create.go            # 新增用户
│       ├── delete.go            # 删除用户
│       ├── get.go               # 获取指定的用户信息
│       ├── list.go              # 查询用户列表
│       ├── login.go             # 用户登录
│       ├── update.go            # 更新用户
│       └── user.go              # 存放用户 handler 公用的函数、结构体等
├── main.go                      # Go 程序唯一入口
├── Makefile                     # Makefile 文件，一般大型软件系统都是采用 make 来作为编译工具
├── model                        # 数据库相关的操作统一放在这里，包括数据库初始化和对表的增删改查
│   ├── init.go                  # 初始化和连接数据库
│   ├── model.go                 # 存放一些公用的 go struct
│   └── user.go                  # 用户相关的数据库 CURD 操作
├── pkg                          # 引用的包
│   ├── auth                     # 认证包
│   │   └── auth.go
│   ├── constvar                 # 常量统一存放位置
│   │   └── constvar.go
│   ├── errno                    # 错误码存放位置
│   │   ├── code.go
│   │   └── errno.go
│   ├── token
│   │   └── token.go
│   └── version                  # 版本包
│       ├── base.go
│       ├── doc.go
│       └── version.go
├── README.md                    # API 目录 README
├── router                       # 路由相关处理
│   ├── middleware               # API 服务器用的是 Gin Web 框架，Gin 中间件存放位置
│   │   ├── auth.go 
│   │   ├── header.go
│   │   ├── logging.go
│   │   └── requestid.go
│   └── router.go
├── service                      # 实际业务处理函数存放位置
│   └── service.go
├── util                         # 工具类函数存放目录
│   ├── util.go 
│   └── util_test.go
└── vendor                       # vendor 目录用来管理依赖包
    ├── github.com
    ├── golang.org
    ├── gopkg.in
    └── vendor.json
```