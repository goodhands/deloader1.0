import Axios from 'axios'

class Category{
    static find(slug) {
        return axios.post('/category/find/' + slug)
    }

    static post(cat_slug) {
        return axios.post('/category/post/' + cat_slug)
    }

    static bestThree(then) {
        return axios.post('/category/best3/')
        .then(( {data} ) => then(data))
    }
}

export default Category;