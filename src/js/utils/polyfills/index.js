import bindPolyfill from './bind'
import trimPolyfill from './trim'
import objCreatePolyfill from './objcreate'
import eventListenerPolyfill from './eventlistener'
import matchmedia from './matchmedia'

export default {
  bindPolyfill: bindPolyfill(),
  trimPolyfill: trimPolyfill(),
  eventListenerPolyfill: eventListenerPolyfill(),
  objCreatePolyfill: objCreatePolyfill(),
  matchMedia: matchmedia()
}

