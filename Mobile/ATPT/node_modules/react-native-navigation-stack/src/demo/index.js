import React, { Component } from 'react';
import { View, Button } from 'react-native';
import { NavigationBar } from '../navigationbar';
import { utils } from '../utils';
export class NavigationBarDemo extends Component {
  constructor(props) {
    super(props);
  }
  render() {
    return (
      <View>
        <NavigationBar
          data={{
            left: '返回',
            title: '标题',
            right: '设置',
            leftNext: '标题',
            titleNext: '密码',
            rightNext: '修改'
          }}
        />
        <View style={{ marginTop: 100 }}>
          <Button
            title="确定"
            onPress={() => {
              utils.navigationBar.next();
            }}
          />
          <Button
            title="返回"
            onPress={() => {
              utils.navigationBar.back();
            }}
          />
        </View>
      </View>
    );
  }
}
