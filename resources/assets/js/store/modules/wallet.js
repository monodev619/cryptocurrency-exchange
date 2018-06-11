import axios from 'axios'
import * as types from '../mutation-types'

import * as urls from '../../constants/url-constants'


export const state = {
    currencies: null
}

export const getters = {
    currencies: state => state.currencies,
    currency: (state) => (symbol) => {
        return state.currencies.find(currency => currency.symbol === symbol)
    }


}

export const mutations = {
    [types.GET_CURRENCIES] (state, {currencies}) {
        state.currencies = currencies
    }
}

export const actions = {
        getCurrencies ({ commit }, payload) {
        commit(types.GET_CURRENCIES, payload)
    }
}

