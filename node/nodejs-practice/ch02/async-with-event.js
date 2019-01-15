class Evente {
    constructor() {
        this.map = {};
    }
    add(name, fn) {
        if (this.map[name]) {
            this.map[name].push(fn);
            return;
        }
        this.map[name] = [fn];
        return this;
    }
    emit(name, ...args) {
        if (!this.map[name]) {
            console.error(`${name} event is not exist`);
            return this;
            
        } 
        this.map[name].forEach(fn => {
            fn(...args);
        });
        return this;
    }
}

let e = new Evente();
e.add('hello', (err, name) => {
    if (err) {
        console.error(err);
        return;        
    }
    console.log(name);
})
.emit('hello', 'There is something wrong...')
.emit('hello1', null, 'hello nodejs');

