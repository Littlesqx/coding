function create (fn) {
    let flag = false;
    return ({next, complete, error}) => {
        function nextFn (...args) {
            if (flag) {
                return;
            }
            next(...args);
        }
        function completeFn (...args) {
            complete(...args);
            flag = true;
        }
        function errorFn (...args) {
            error(...args);
        }
        fn({
            next: nextFn,
            complete: completeFn,
            error: errorFn
        });
        return _ => flag = true;
    }
}

let observerable = create(observer => {
    setTimeout(_ => observer.next(1), 1000);
    observer.next(2);
    observer.complete(3);
});

const subject = {
    next: value => console.log(value),
    complete: console.log,
    error: console.log
};

let unsubscribe = observerable(subject);