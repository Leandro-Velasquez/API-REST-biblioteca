export class ConnectAPI {
    constructor(url) {
        this.url = url
    }

    getResource(fn, id = '') {
        if(id === '') {
            fetch(this.url)
            .then(response => response.json())
            .then(data => fn(data))
        }else {
            fetch(`${this.url}${id}`)
            .then(response => response.json())
            .then(data => fn(data))
        }
    }

    postResource(data) {
        fetch(this.url, {
            method: 'POST',
            body: data,
        })
        .then(data => data.json())
        .then(res => console.log(res))
        .catch(err => console.log(err))
    }
}