let actions = {
    SEARCH_FOODS({commit}, query) {
        let params = {
            query
        };
        axios.get(`/api/foods/searchFoods`, {params})
            .then(res => {
                if (res.data === 'ok')
                    console.log('request sent successfully')

            }).catch(err => {
            console.log(err)
        })
    },
    GET_FOODS({commit}) {
        axios.get('/api/foods/searchFoods')
            .then(res => {
                {
                    commit('SET_FOODS', res.data)
                }
            })
            .catch(err => {
                console.log(err)
            })
    }
}

export default actions