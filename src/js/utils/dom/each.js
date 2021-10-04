export default (nodelist, callback) => {
  let i = -1;
  const l = nodelist.length;

  // eslint-disable-next-line node/no-callback-literal
  while (++i < l) callback({ el: nodelist.item(i), index: i });
};
