import { SimpleNavigation } from './';
import { config } from './config';
import { NavigationBar } from './navigationbar';
type tUtils = { simpleNavigation: ?SimpleNavigation, navigationBar: ?NavigationBar, dxToValue: ({ targetWidth: number, dx: number }) => number };
export let utils: tUtils = {
  simpleNavigation: null,
  navigationBar: null,
  /**
   * dx根据对应目标值转换为对应值
   */
  dxToValue: (targetWidth, dx) => {
    return (dx / config.screenWidth) * targetWidth;
  }
};
