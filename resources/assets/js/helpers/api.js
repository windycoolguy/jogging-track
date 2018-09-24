import axios from 'axios'
import Auth from '../store/auth'

export function get(url) {
    return axios({
        method: 'GET',
        url: url,
        headers: {
            'Authorization': `Bearer ${Auth.state.api_token}`
        }
    })
}

export function post(url, data) {
    return axios({
        method: 'POST',
        url: url,
        data: data,
        headers: {
            'Authorization': `Bearer ${Auth.state.api_token}`
        }
    })
}

export function upload(url, file) {
    let formData = new FormData()
    formData.append('file', file);
    return axios.post( url,
        formData,
        {
            headers: {
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${Auth.state.api_token}`
            }
        }
    );
}
