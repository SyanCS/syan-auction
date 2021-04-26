import APIService from '@/services/APIService.js'

const backend_controller = '/auto-bids/'
export default {
  saveAutoBidAmount (amount) {
    return APIService.apiCall().get(backend_controller+'save'+'/'+amount+'.json')
  },

  getUserAutoBid (userId) {
    return APIService.apiCall().get(backend_controller+'get-user-auto-bid'+'/'+userId+'.json')
  },
}
