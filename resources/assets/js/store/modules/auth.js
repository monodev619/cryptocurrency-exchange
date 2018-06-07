import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'
import  * as urls from '../../constants/url-constants';

// state
export const state = {
  user: null,
  profile: null,
  token: Cookies.get('token')
}

// getters
export const getters = {
  user: state => state.user,
  profile: state => state.profile,
  token: state => state.token,
  check: state => state.user !== null
}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 1 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null;
    Cookies.remove('token')
  },

  [types.FETCH_PROFILE_SUCCESS] (state, { profile }) {
      state.profile = profile;
  },

  [types.FETCH_PROFILE_FAILURE] (state) {
      state.profile = null;
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.profile = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    commit(types.SAVE_TOKEN, payload)
  },

  async fetchUser ({ commit, state }) {
    try {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token;
      const { data } = await axios.get(urls.API_BASE_URL + '/_api/user');

      commit(types.FETCH_USER_SUCCESS, { user: data.data });
    } catch (e) {
      commit(types.FETCH_USER_FAILURE)
    }
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  async fetchProfile ({ commit, state }) {
    try {
        const { data } = await axios.get(urls.API_BASE_URL + '/_api/getProfile');

        commit(types.FETCH_PROFILE_SUCCESS, { profile: data.data });
    } catch (e) {
        commit(types.FETCH_PROFILE_FAILURE)
    }
  },

  async logout ({ commit }) {
    try {
      await axios.post(urls.API_BASE_URL + '/_api/logout')
    } catch (e) { }

    commit(types.LOGOUT)
  },

  async fetchOauthUrl (ctx, { provider }) {
    const { data } = await axios.post(`/api/oauth/${provider}`)

    return data.url
  }
}
