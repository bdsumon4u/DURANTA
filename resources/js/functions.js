export const ucfirst = str => str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
export const ucwords = (str, sep = ' ', join = ' ') => str.split(sep).map(word => ucfirst(word)).join(join);
