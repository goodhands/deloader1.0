import Axios from 'axios'

class Posts{
    static find(slug) {
        return axios.post('/posts/find/' + slug)
    }

    static all(then){
        return axios.post('/posts')
        .then(( {data} ) => then(data))
    }

    static featured(then){
        return axios.post('/posts/featured')
        .then(( {data} ) => then(data))
    }

    static gallery(then){
        return axios.post('/posts/gallery')
        .then(( {data} ) => then(data))
    }

    static quotes(then){
        return axios.post('/posts/quotes')
        .then(( {data} ) => then(data))
    }

    static notable(then){
        return axios.post('/posts/notables')
        .then(( {data} ) => then(data))
    }

    static years(then){
        return axios.post('/posts/years')
        .then(( {data} ) => then(data))
    }

    static postsByYear(year){
        return axios.post('/archive/' + year)
    }
}

export default Posts;