async function func () {
    return 2;
}

func().then(console.log); // func() return a promise

const getPosts = _ => new Promise((resolve, reject) => {
    resolve([
        {
            name: 'a'
        },
        {
            name: 'b'
        },
        {
            name: 'c'
        }
    ]);
});

async function func2 () {
    try {
        const number = await func();
        const posts = await getPosts();
        console.log(number);
        console.log(posts);
    } catch (e) {
        console.log(e);
    }
}

func2();